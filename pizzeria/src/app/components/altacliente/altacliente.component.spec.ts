import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AltaclienteComponent } from './altacliente.component';

describe('AltaclienteComponent', () => {
  let component: AltaclienteComponent;
  let fixture: ComponentFixture<AltaclienteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AltaclienteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AltaclienteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
