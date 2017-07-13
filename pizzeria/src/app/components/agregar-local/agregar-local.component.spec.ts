import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AgregarLocalComponent } from './agregar-local.component';

describe('AgregarLocalComponent', () => {
  let component: AgregarLocalComponent;
  let fixture: ComponentFixture<AgregarLocalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AgregarLocalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AgregarLocalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
